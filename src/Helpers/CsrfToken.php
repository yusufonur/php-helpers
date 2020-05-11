<?php
namespace yusufonur\Helpers;

class CsrfToken
{
    protected $token_name = '_token';

    protected $token_length = 32;

    protected $field_format = "<input type='hidden' name='%s' value='%s'>";


    /**
     * Check Csrf-Token exists
     *
     * @return bool
     */
    public function check()
    {
        if (isset($_SESSION[$this->token_name])) {
            return true;
        }

        return false;
    }

    /**
     * Creates Csrf-Token if not present. If the reset parameter is true, it regenerates.
     *
     * @param bool $reset
     * @return mixed
     */
    public function set($reset = false)
    {
        if (!$this->check() or $reset) {
            $_SESSION[$this->token_name] = $this->generate();
        }

        return $this->get();
    }

    /**
     * Regenerate Csrf-Token
     *
     * @return mixed
     */
    public function reset()
    {
        return $this->set(true);
    }

    /**
     * Csrf-Token returns if any, otherwise it creates and returns.
     *
     * @return mixed
     */
    public function get()
    {
        if (!$this->check()) {
            $this->set();
        }

        return $_SESSION[$this->token_name];
    }

    /**
     * Prepares and returns Csrf-Field input.
     *
     * @return string
     */
    public function field()
    {
        return sprintf($this->field_format, $this->token_name, $this->get());
    }


    /**
     * Returns the result of Csrf-Token comparison with incoming Csrf-Token value.
     *
     * @param string $token
     * @return bool
     */
    public function validate(string $token)
    {
        return $this->get() == $token;
    }


    /**
     * Generate and return Csrf-Token
     *
     * @return false|string
     */
    private function generate()
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $this->token_length);
    }
}