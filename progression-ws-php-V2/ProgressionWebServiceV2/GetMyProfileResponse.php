<?php

namespace ProgressionWebService;

class GetMyProfileResponse
{

    /**
     * @var Profile $profile
     */
    protected $profile = null;

    /**
     * @param Profile $profile
     */
    public function __construct($profile = null)
    {
      $this->profile = $profile;
    }

    /**
     * @return Profile
     */
    public function getProfile()
    {
      return $this->profile;
    }

    /**
     * @param Profile $profile
     * @return \ProgressionWebService\GetMyProfileResponse
     */
    public function setProfile($profile)
    {
      $this->profile = $profile;
      return $this;
    }

}
