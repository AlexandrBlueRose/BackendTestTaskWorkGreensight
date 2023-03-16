<?php
class User
{
    private $id;
	private $name;
	private $email;
		
	public function __construct($id, $name, $email)
	{
		$this->id = $id;
		$this->name = $name;
        $this->email = $email;
	}

    public function getName()
	{
			return $this->name;
	}

    public function getEmail()
	{
			return $this->email;
	}

    public function getId()
	{
			return $this->id;
	}
	public static function validateEmailAddress($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+./', $email);
    }
}
?>