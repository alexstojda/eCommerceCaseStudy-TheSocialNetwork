<?php

/**
 * @property string title
 * @property array posts
 * @property string error
 * @property string name
 * @property string description
 * @property string privacy
 * @property array groups
 * @property bool validName
 * @property string members
 * @property mixed receivedMessages
 * @property mixed sentMessages
 * @property mixed messages
 * @property mixed fromid
 * @property mixed toid
 * @property string noUserError
 * @property null post
 * @property _User|bool newUser
 * @property mixed genders
 * @property bool|DateTime minDate
 * @property mixed countries
 * @property string gender
 * @property string country
 * @property bool canSubmit
 * @property string usernameError
 * @property string passwordError
 * @property string emailError
 * @property string firstNameError
 * @property string lastNameError
 * @property string genderError
 * @property string phoneError
 * @property string cityError
 * @property string provinceError
 * @property string countryError
 * @property string codeError
 * @property string foundUsers
 * @property string foundGroups
 * @property string id
 * @property string friendButtonText
 * @property string friendButtonTarget
 * @property string user
 * @property string dobError
 * @property string addressError
 * @property DateTime maxDate
 */
class View
{
    /**
     * @var array $alerts
     */
    public $alerts;

    public function __construct()
    {
        //echo 'this is a view';
    }

    public function render($name, $noInclude = false)
    {
        if ($noInclude) {
            /** @noinspection PhpIncludeInspection */
            /** @noinspection PhpIncludeInspection */
            require PATH . 'views/' . $name . '.php';
        } else {
            /** @noinspection PhpIncludeInspection */
            /** @noinspection PhpIncludeInspection */
            require PATH . 'views/header.php'; //replace by navbar eventually
            /** @noinspection PhpIncludeInspection */
            /** @noinspection PhpIncludeInspection */
            require PATH . 'views/navbar/index.php';

            //Rudementary alerts
            if (isset($this->alerts)) {
                foreach ($this->alerts as $alert) {
                    Controller::anAlert($alert[0], $alert[1]);
                }
            }

            /** @noinspection PhpIncludeInspection */
            /** @noinspection PhpIncludeInspection */
            require PATH . 'views/' . $name . '.php';
            /** @noinspection PhpIncludeInspection */
            /** @noinspection PhpIncludeInspection */
            require PATH . 'views/footer.php';
        }
    }

}