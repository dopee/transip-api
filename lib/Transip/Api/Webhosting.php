<?php

namespace Transip\Api;

/**
 * This is the API endpoint for the WebhostingService
 *
 * @package Transip
 * @class   WebhostingService
 * @author  TransIP (support@transip.nl)
 * @author  Mitchel Verschoof (mitchel@verschoof.net)
 * @author  Sander Krul (sander@dope-e.nl)
 * @version 20170413 15:20
 */
class Webhosting extends SoapClientAbstract
{
    const CANCELLATIONTIME_END         = 'end';
    const CANCELLATIONTIME_IMMEDIATELY = 'immediately';

    /**
     * Gets the singleton SoapClient which is used to connect to the TransIP Api.
     *
     * @param  array $parameters Parameters.
     * @return \SoapClient The SoapClient object to which we can connect to the TransIP API
     */
    public function getSoapClient(array $parameters = array())
    {
        $classMap = array(
            'WebhostingPackage' => 'Transip\\Model\\WebhostingPackage',
            'WebHost'           => 'Transip\\Model\\WebHost',
            'Cronjob'           => 'Transip\\Model\\Cronjob',
            'MailBox'           => 'Transip\\Model\\MailBox',
            'Db'                => 'Transip\\Model\\Db',
            'MailForward'       => 'Transip\\Model\\MailForward',
            'SubDomain'         => 'Transip\\Model\\SubDomain',
        );

        $this->service = 'WebhostingService';

        return $this->soapClient($classMap, $parameters);
    }

    /**
     * Get all domain names that have a webhosting package attached to them.
     *
     * @return string[] List of domain names that have a webhosting package
     */
    public function getWebhostingDomainNames()
    {
        return $this->getSoapClient(array_merge(array(), array('__method' => 'getWebhostingDomainNames')))->getWebhostingDomainNames();
    }

    /**
     * Get available webhosting packages
     *
     * @return \Transip\Model\WebhostingPackage[] List of available webhosting packages
     */
    public function getAvailablePackages()
    {
        return $this->getSoapClient(array_merge(array(), array('__method' => 'getAvailablePackages')))->getAvailablePackages();
    }

    /**
     * Get information about existing webhosting on a domain.
     *
     * Please be aware that the information returned is outdated when
     * a modifying function in Transip_WebhostingService is called (e.g. createCronjob()).
     *
     * Call this function again to refresh the info.
     *
     * @param string $domainName The domain name of the webhosting package to get the info for. Must be owned by this user
     * @return \Transip\Model\WebHost WebHost object with all info about the requested webhosting package
     */
    public function getInfo($domainName)
    {
        return $this->getSoapClient(array_merge(array($domainName), array('__method' => 'getInfo')))->getInfo($domainName);
    }

    /**
     * Order webhosting for a domain name
     *
     * @param string                           $domainName        The domain name to order the webhosting for. Must be owned by this user
     * @param \Transip\Model\WebhostingPackage $webhostingPackage The webhosting Package to order, one of the packages returned by Transip_WebhostingService::getAvailablePackages()
     * @throws \Transip\Exception\\Transip\Exception\ApiException on error
     */
    public function order($domainName, \Transip\Model\WebhostingPackage $webhostingPackage)
    {
        return $this->getSoapClient(array_merge(array($domainName, $webhostingPackage), array('__method' => 'order')))->order($domainName, $webhostingPackage);
    }

    /**
     * Get available upgrades packages for a domain name with webhosting. Only those packages will be returned to which
     * the given domain name can be upgraded to.
     *
     * @param string $domainName Domain to get upgrades for. Must be owned by the current user.
     * @return \Transip\Model\WebhostingPackage[] Available packages to which the domain name can be upgraded to.
     * @throws \Transip\Exception\ApiException Throwns an Exception ig the domain is not found in the requester account
     */
    public function getAvailableUpgrades($domainName)
    {
        return $this->getSoapClient(array_merge(array($domainName), array('__method' => 'getAvailableUpgrades')))->getAvailableUpgrades($domainName);
    }

    /**
     * Upgrade the webhosting of a domain name to a new webhosting package to a given new package.
     *
     * @param string $domainName           The domain to upgrade webhosting for. Must be owned by the current user.
     * @param string $newWebhostingPackage The new webhosting package, must be one of the packages returned getAvailableUpgrades() for the given domain name
     * @throws \Transip\Exception\ApiException Throws an exception when the domain name does not belong to the requester (or is not found) or the package can't be upgraded
     */
    public function upgrade($domainName, $newWebhostingPackage)
    {
        return $this->getSoapClient(array_merge(array($domainName, $newWebhostingPackage), array('__method' => 'upgrade')))->upgrade($domainName, $newWebhostingPackage);
    }

    /**
     * Cancel webhosting for a domain
     *
     * @param string $domainName The domain to cancel the webhosting for
     * @param string $endTime    the time to cancel the domain (WebhostingService::CANCELLATIONTIME_END (end of contract) or WebhostingService::CANCELLATIONTIME_IMMEDIATELY (as soon as possible))
     * @throws \Transip\Exception\ApiException Throws an exception when the domain name does not belong to the requester (or is not found).
     */
    public function cancel($domainName, $endTime)
    {
        return $this->getSoapClient(array_merge(array($domainName, $endTime), array('__method' => 'cancel')))->cancel($domainName, $endTime);
    }

    /**
     * Set a new FTP password for a webhosting package
     *
     * @param string $domainName  Domain to set webhosting FTP password for
     * @param string $newPassword The new FTP password for the webhosting package
     * @throws \Transip\Exception\ApiException When the new password is empty
     */
    public function setFtpPassword($domainName, $newPassword)
    {
        return $this->getSoapClient(array_merge(array($domainName, $newPassword), array('__method' => 'setFtpPassword')))->setFtpPassword($domainName, $newPassword);
    }

    /**
     * Create a cronjob
     *
     * @param string                 $domainName the domain name of the webhosting package to create cronjob for
     * @param \Transip\Model\Cronjob $cronjob    the cronjob to create. All fields must be valid.
     * @throws \Transip\Exception\ApiException When the new URL is either invalid or the URL is not a URL linking to the domain the CronJob is for.
     */
    public function createCronjob($domainName, \Transip\Model\Cronjob $cronjob)
    {
        return $this->getSoapClient(array_merge(array($domainName, $cronjob), array('__method' => 'createCronjob')))->createCronjob($domainName, $cronjob);
    }

    /**
     * Delete a cronjob from a webhosting package.
     * Note, all completely matching cronjobs will be removed
     *
     * @param string                 $domainName the domain name of the webhosting package to delete a cronjob
     * @param \Transip\Model\Cronjob $cronjob    Cronjob the cronjob to delete. Be aware that all matching cronjobs will be removed.
     * @throws \Transip\Exception\ApiException When the CronJob that needs to be deleted is not found.
     */
    public function deleteCronjob($domainName, \Transip\Model\Cronjob $cronjob)
    {
        return $this->getSoapClient(array_merge(array($domainName, $cronjob), array('__method' => 'deleteCronjob')))->deleteCronjob($domainName, $cronjob);
    }

    /**
     * Creates a MailBox for a webhosting package.
     * The address field of the MailBox object must be unique.
     *
     * @param string                 $domainName the domain name of the webhosting package to create the mailbox for
     * @param \Transip\Model\MailBox $mailBox    MailBox object to create
     */
    public function createMailBox($domainName, \Transip\Model\MailBox $mailBox)
    {
        return $this->getSoapClient(array_merge(array($domainName, $mailBox), array('__method' => 'createMailBox')))->createMailBox($domainName, $mailBox);
    }

    /**
     * Modifies MailBox settings
     *
     * @param string                 $domainName the domain name of the webhosting package to modify the mailbox for
     * @param \Transip\Model\MailBox $mailBox    the MailBox to modify
     * @throws \Transip\Exception\ApiException When the MailBox that needs to be modified is not found.
     */
    public function modifyMailBox($domainName, \Transip\Model\MailBox $mailBox)
    {
        return $this->getSoapClient(array_merge(array($domainName, $mailBox), array('__method' => 'modifyMailBox')))->modifyMailBox($domainName, $mailBox);
    }

    /**
     * Sets a new password for a MailBox
     *
     * @param string                 $domainName  the domain name of the webhosting package to set the mailbox password for
     * @param \Transip\Model\MailBox $mailBox     the MailBox to set the password for
     * @param string                 $newPassword the new password for the MailBox, cannot be empty.
     * @throws \Transip\Exception\ApiException When the MailBox that needs to be modified is not found.
     */
    public function setMailBoxPassword($domainName, \Transip\Model\MailBox $mailBox, $newPassword)
    {
        return $this->getSoapClient(array_merge(array($domainName, $mailBox, $newPassword), array('__method' => 'setMailBoxPassword')))->setMailBoxPassword($domainName, $mailBox, $newPassword);
    }

    /**
     * Deletes a MailBox from a webhosting package
     *
     * @param string                 $domainName the domain name of the webhosting package to remove the MailBox from
     * @param \Transip\Model\MailBox $mailBox    the mailbox object to remove
     * @throws \Transip\Exception\ApiException When the MailBox that needs to be deleted is not found.
     */
    public function deleteMailBox($domainName, \Transip\Model\MailBox $mailBox)
    {
        return $this->getSoapClient(array_merge(array($domainName, $mailBox), array('__method' => 'deleteMailBox')))->deleteMailBox($domainName, $mailBox);
    }

    /**
     * Creates a MailForward for a webhosting package
     *
     * @param string                     $domainName  the domain name of the webhosting package to add the MailForward to
     * @param \Transip\Model\MailForward $mailForward The MailForward object to create
     */
    public function createMailForward($domainName, \Transip\Model\MailForward $mailForward)
    {
        return $this->getSoapClient(array_merge(array($domainName, $mailForward), array('__method' => 'createMailForward')))->createMailForward($domainName, $mailForward);
    }

    /**
     * Changes an active MailForward object
     *
     * @param string                     $domainName  the domain name of the webhosting package to modify the MailForward from
     * @param \Transip\Model\MailForward $mailForward the MailForward to modify
     * @throws \Transip\Exception\ApiException When the MailForward that needs to be modified is not found.
     */
    public function modifyMailForward($domainName, \Transip\Model\MailForward $mailForward)
    {
        return $this->getSoapClient(array_merge(array($domainName, $mailForward), array('__method' => 'modifyMailForward')))->modifyMailForward($domainName, $mailForward);
    }

    /**
     * Deletes an active MailForward object
     *
     * @param string                     $domainName  the domain name of the webhosting package to delete the MailForward from
     * @param \Transip\Model\MailForward $mailForward the MailForward to delete
     */
    public function deleteMailForward($domainName, \Transip\Model\MailForward $mailForward)
    {
        return $this->getSoapClient(array_merge(array($domainName, $mailForward), array('__method' => 'deleteMailForward')))->deleteMailForward($domainName, $mailForward);
    }

    /**
     * Creates a new database
     *
     * @param string            $domainName the domain name of the webhosting package to create the Db for
     * @param \Transip\Model\Db $db         Db object to create
     */
    public function createDatabase($domainName, \Transip\Model\Db $db)
    {
        return $this->getSoapClient(array_merge(array($domainName, $db), array('__method' => 'createDatabase')))->createDatabase($domainName, $db);
    }

    /**
     * Changes a Db object
     *
     * @param string            $domainName the domain name of the webhosting package to change the Db for
     * @param \Transip\Model\Db $db         The db object to modify
     */
    public function modifyDatabase($domainName, \Transip\Model\Db $db)
    {
        return $this->getSoapClient(array_merge(array($domainName, $db), array('__method' => 'modifyDatabase')))->modifyDatabase($domainName, $db);
    }

    /**
     * Sets A database password for a Db
     *
     * @param string            $domainName  the domain name of the webhosting package of the Db to change the password for
     * @param \Transip\Model\Db $db          Modified database object to save
     * @param string            $newPassword New password for the database
     */
    public function setDatabasePassword($domainName, \Transip\Model\Db $db, $newPassword)
    {
        return $this->getSoapClient(array_merge(array($domainName, $db, $newPassword), array('__method' => 'setDatabasePassword')))->setDatabasePassword($domainName, $db, $newPassword);
    }

    /**
     * Deletes a Db object
     *
     * @param string            $domainName the domain name of the webhosting package to delete the Db for
     * @param \Transip\Model\Db $db            Db object to remove
     * @throws \Transip\Exception\\Transip\Exception\ApiException When the Database that needs to be deleted is not found.
     */
    public function deleteDatabase($domainName, $db)
    {
        return $this->getSoapClient(array_merge(array($domainName, $db), array('__method' => 'deleteDatabase')))->deleteDatabase($domainName, $db);
    }

    /**
     * Creates a SubDomain
     *
     * @param string                   $domainName the domain name of the webhosting package to create the SubDomain for
     * @param \Transip\Model\SubDomain $subDomain  SubDomain object to create
     */
    public function createSubdomain($domainName, \Transip\Model\SubDomain $subDomain)
    {
        return $this->getSoapClient(array_merge(array($domainName, $subDomain), array('__method' => 'createSubdomain')))->createSubdomain($domainName, $subDomain);
    }

    /**
     * Deletes a SubDomain
     *
     * @param string                   $domainName the domain name of the webhosting package to delete the SubDomain for
     * @param \Transip\Model\SubDomain $subDomain  SubDomain object to delete
     * @throws \Transip\Exception\ApiException When the Subdomain that needs to be deleted is not found.
     */
    public function deleteSubdomain($domainName, \Transip\Model\SubDomain $subDomain)
    {
        return $this->getSoapClient(array_merge(array($domainName, $subDomain), array('__method' => 'deleteSubdomain')))->deleteSubdomain($domainName, $subDomain);
    }
}
