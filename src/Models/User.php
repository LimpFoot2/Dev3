<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Models;

use GrahamCampbell\BootstrapCMS\Models\Relations\Common\HasManyCommentsTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\HasManyEventsTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\HasManyPagesTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Common\HasManyPostsTrait;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyCommentsInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyEventsInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyPagesInterface;
use GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces\HasManyPostsInterface;
use GrahamCampbell\Credentials\Models\User as CredentialsUser;

/**
 * This is the user model class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class User extends CredentialsUser implements HasManyPagesInterface, HasManyPostsInterface, HasManyEventsInterface, HasManyCommentsInterface
{
    use HasManyPagesTrait, HasManyPostsTrait, HasManyEventsTrait, HasManyCommentsTrait;

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenter()
    {
        return 'GrahamCampbell\BootstrapCMS\Presenters\UserPresenter';
    }

    /**
     * Before deleting an existing model.
     *
     * @return void
     */
    public function beforeDelete()
    {
        $this->deletePages();
        $this->deletePosts();
        $this->deleteEvents();
        $this->deleteComments();
    }
}