<?php
namespace App\Security;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use App\Entity\Post;
use Symfony\Component\Security\Core\User\UserInterface;

class PostVoter extends Voter
{
    public const POST_EDIT = 'POST_EDIT';
    public const POST_DELETE = 'POST_DELETE';

    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, [self::POST_EDIT, self::POST_DELETE])
            && $subject instanceof Post;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        /** @var Post $post */
        $post = $subject;

        switch ($attribute) {
            case self::POST_EDIT:
            case self::POST_DELETE:
                return $post->getAuthor()->getId() === $user->getId();
        }

        return false;
    }
}
