<?php
require_once 'core/init.php';

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, [
			'username' => [
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'users'
			],
			'password' => [
				'required' => true,
				'min' => 6,
			],
			'password_again' => [
				'required' => true,
				'matches' => 'password'
			],
			'name' => [
				'required' => true,
				'min' => 2,
				'max' =>  50,
			],
			'surname' => [
				'required' => true,
				'min' => 2,
				'max' => 50
			],
			'id_no' => [
				'require' => true,
				'min' => 13,
				'max' => 13,
				'is_num' => true
			],
			'contact_no' => [
				'require' => true,
				'min' => 10,
				'max' => 10,
				'is_num' => true
			],
			'email_address' => [
				'required' => true,
				'valid' => true,
				'unique' => 'users'
			]

		]);

		if($validation->passed()) {
			$user = new User();
			$salt = Hash::salt(32);

			try {
				$user->create([
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'name' => Input::get('name'),
					'surname' => Input::get('surname'),
					'id_no' => Input::get('id_no'),
					'email_address' => Input::get('email_address'),
					'contact_no' => Input::get('contact_no'),
					'address' => Input::get('address')
				]);
				Session::flash('home', 'Registration successful and you can now login in!');
				Redirect::to('index.php');
			} catch(Exception $e) {
				echo $e->getMessage();
				Redirect::to('register.php');
			}
		}
		else {
			foreach($validation->errors() as $error) {
				echo '<p style="color:red">' . $error . '</p>';
			}
		}
	}
}
?>

<form action="" method="post" >
	<div class="field">
		<label for="email_address">Email</label>
		<input type="email_address" name="email_address" id="email_address" value="<? echo Input::get('email_address'); ?>">
	</div>

	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<? echo escape(Input::get('username')); ?>" autocomplete="off">
	</div>

	<div class="field">
		<label for="password">Choose password</label>
		<input type="password" name="password" id="password">
	</div>

	<div class="field">
		<label for="password_again">Re-type password</label>
		<input type="password" name="password_again" id="password_again">
	</div>

	<div class="field">
		<label for="name">Name</label>
		<input type="text" name="name" id="name" value="<? echo escape(Input::get('name')); ?>">
	</div>

	<div class="field">
		<label for="surname">Surname</label>
		<input type="text" name="surname" id="surname" value="<? echo escape(Input::get('surname')); ?>">
	</div>

	<div class="field">
		<label for="id_no">ID Number</label>
		<input type="text" name="id_no" id="id_no" value="<? echo escape(Input::get('id_no')); ?>">
	</div>

	<div class="field">
		<label for="contact_no">Contact Number</label>
		<input type="text" name="contact_no" id="contact_no" value="<? echo escape(Input::get('contact_no')); ?>">
	</div>

	<div class="field">
		<label for="addres">Address</label>
		<input type="text" name="address" id="address" value="<? echo escape(Input::get('address')); ?>">
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="register">

</form>