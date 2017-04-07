<?php


namespace App\Repositories\Ad;


use Adldap\Laravel\Facades\Adldap;
use App\Models\Ad\User;
use App\Repositories\UserRepositoryInterface;

class AdUserRepository implements UserRepositoryInterface
{

    public function getByAccount($account)
    {
        $adUser = Adldap::search()->users()->findBy('samaccountname', $account);
        return $this->mapAdUserToUser($adUser);
    }

    /**
     *
     * @param \Adldap\Models\User $adUser
     * @return User
     */
    public function mapAdUserToUser(\Adldap\Models\User $adUser)
    {
        $user = new User();
        $user->account = $adUser->getAccountName();
        $user->name = $adUser->getName();
        $user->displayName = $adUser->getDisplayName();
        $user->firstName = $adUser->getFirstName();
        $user->lastName = $adUser->getLastName();
        $user->middleName = $adUser->getFirstAttribute('middlename');
        $user->title = $adUser->getTitle();
        $user->localPhone = $adUser->getTelephoneNumber();
        $user->cityPhone = $adUser->getFirstAttribute('pager');
        $user->mobilePhone = $adUser->getFirstAttribute('mobile');
        $user->mail = $adUser->getFirstAttribute('mail');
        $user->externalMail = $adUser->getFirstAttribute('homephone');
        $user->office = $adUser->getPhysicalDeliveryOfficeName();
        $user->department = $adUser->getDepartment();
        $user->enabled = $adUser->isEnabled();
        return $user;
    }
}