<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends AbstractController
{
    #[Route('/api/posts', name: 'api_posts_list', methods: ['GET'])]
    public function list(EntityManagerInterface $em): JsonResponse
    {
        $posts = $em->getRepository(Post::class)->findAll();
        $data = [];

        foreach ($posts as $post) {
            $data[] = [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'description' => $post->getDescription(),
                'tags' => $post->getTags(),
                'type' => $post->getType(),
                'author' => $post->getAuthor() ? $post->getAuthor()->getNickname() : null,
            ];
        }

        return $this->json($data);
    }

    #[Route('/api/posts/{id}', name: 'api_post_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $em): JsonResponse
    {
        $post = $em->getRepository(Post::class)->find($id);

        if (!$post) {
            throw new NotFoundHttpException('Post not found');
        }

        return $this->json([
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'description' => $post->getDescription(),
            'tags' => $post->getTags(),
            'type' => $post->getType(),
            'author' => $post->getAuthor() ? $post->getAuthor()->getNickname() : null,
        ]);
    }

    #[Route('/api/posts', name: 'api_post_add', methods: ['POST'])]
    public function add(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['error' => 'You must be logged in to add a post.'], 401);
        }

        $data = json_decode($request->getContent(), true);
        if (!isset($data['title'], $data['description'], $data['type'])) {
            return $this->json(['error' => 'Missing required fields: title, description, type'], 400);
        }

        $post = new Post();
        $post->setTitle($data['title']);
        $post->setDescription($data['description']);
        // Jeśli tags jest tablicą, zamieniamy na string rozdzielony przecinkami
        $tags = $data['tags'] ?? '';
        if (is_array($tags)) {
            $tags = implode(',', $tags);
        }
        $post->setTags($tags);
        $post->setType($data['type']);
        $post->setAuthor($user);

        $em->persist($post);
        $em->flush();

        return $this->json(['status' => 'Post created', 'id' => $post->getId()], 201);
    }

    #[Route('/api/posts/{id}', name: 'api_post_edit', methods: ['PUT'])]
    public function edit(int $id, Request $request, EntityManagerInterface $em): JsonResponse
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw new NotFoundHttpException('Post not found');
        }

        $this->denyAccessUnlessGranted('POST_EDIT', $post);

        $data = json_decode($request->getContent(), true);

        if (isset($data['title'])) {
            $post->setTitle($data['title']);
        }
        if (isset($data['description'])) {
            $post->setDescription($data['description']);
        }
        if (isset($data['tags'])) {
            $tags = $data['tags'];
            if (is_array($tags)) {
                $tags = implode(',', $tags);
            }
            $post->setTags($tags);
        }
        if (isset($data['type'])) {
            $post->setType($data['type']);
        }

        $em->flush();

        return $this->json(['status' => 'Post updated']);
    }

    #[Route('/api/posts/{id}', name: 'api_post_delete', methods: ['DELETE'])]
    public function delete(int $id, EntityManagerInterface $em): JsonResponse
    {
        $post = $em->getRepository(Post::class)->find($id);
        if (!$post) {
            throw new NotFoundHttpException('Post not found');
        }

        $this->denyAccessUnlessGranted('POST_DELETE', $post);

        $em->remove($post);
        $em->flush();

        return $this->json(['status' => 'Post deleted']);
    }
}
