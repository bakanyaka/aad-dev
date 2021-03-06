<?php


namespace App\Repositories\Ad;


use Adldap\Laravel\Facades\Adldap;
use App\Models\Ad\User;
use App\Repositories\UserRepositoryInterface;
use Carbon\Carbon;

class AdUserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        $adUsers = Adldap::search()->where([
            Adldap::getSchema()->objectClass() => Adldap::getSchema()->objectClassUser(),
            Adldap::getSchema()->objectCategory() => Adldap::getSchema()->objectCategoryPerson(),
        ])->paginate()->getResults();
        return collect($adUsers)->map([$this, 'mapAdUserToUser']);
    }

    public function getByAccount($account)
    {
        $adUser = Adldap::search()->users()->findBy('samaccountname', $account);
        return $adUser ? $this->mapAdUserToUser($adUser) : null;
    }

    public function findByName($name)
    {
        $adUsers = Adldap::search()->users()->whereContains('name', $name)->get();
        return $adUsers->map([$this, 'mapAdUserToUser']);
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
        if ($adUser->getLastLogon()) {
        $user->lastLogon = Carbon::createFromTimestamp(convertWindowsTimeToUnixTime($adUser->getLastLogon()));
        } else {
            $user->lastLogon = null;
        }

        return $user;
    }

}