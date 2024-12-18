<?php
/**
 * Event class
 *
 * @package auth_saml2sso
 * @copyright  2018 Marco Ferrante
 * @author Marco Ferrante, AulaWeb/University of Genoa <staff@aulaweb.unige.it>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace auth_saml2sso\event;

require_once($CFG->dirroot.'/auth/saml2sso/locallib.php');

/**
 * User exists under another plugin.
 **/
class duplicate_user extends \core\event\base {

    /**
     * Create instance of event.
     *
     * @param string $identifier the duplicate identfier.
     * @return duplicate_user
     */
    public static function event_duplicate_user($identifier, $value, $authplugin) {
        $data = [
            'context' => \context_system::instance(),
            'other' => [
                'key' => $identifier,
                'id' => $value,
                'auth' => $authplugin,
            ]
        ];

        return self::create($data);
    }

    protected function init() {
        $this->context = \context_system::instance();
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    public static function get_name() {
        return get_string('event_duplicate_user', \auth_saml2sso\COMPONENT_NAME);
    }

    public function get_description() {
        return get_string('event_duplicate_user_desc', \auth_saml2sso\COMPONENT_NAME, $this->other);
    }

}