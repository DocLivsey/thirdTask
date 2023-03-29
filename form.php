<link rel="stylesheet" href="style.css"></link>
<style>
<?php include 'style.css'; ?>
</style>
<div class="main-content">
    <div class="under-form">
      <div class="form">
        <form action="" method="POST" class="user-form" id="user-form">
          <h2 class="header-user-form">Create an account</h2>
          <div class="user-name-field users-fields">
            <label>enter your full name*</label>
            <input placeholder="your full name" type="text" name="user_name" id="user-name">
          </div>
          <div class="user-email-field users-fields">
            <label>enter your email*</label>
            <input placeholder="your email" type="email" name="user_mail" id="user-mail">
          </div>
          <div class="user-bday-field users-fields">
            <label>select year of your birth*</label>
            <select name="user_birth" id="user-birth">
                <?php
                    for ($i = 1923; $i <= 2023; $i++) {
                        printf('<option value="%d">%d year</option>', $i, $i);
                    }
                ?>
            </select>
          </div>
          <div class="input-gender users-fields">
            <label>select your gender*</label>
            <input type="radio" name="user_gender[]" id="user-gender1" value="male"><label>male</label>
            <input type="radio" name="user_gender[]" id="user-gender2" value="female"><label>female</label>
          </div>
          <div class="input-limbs users-fields">
            <label>select your limbs count*</label>
            <input type="radio" name="user_limb[]" id="user-limb1" value="1"><label>1</label>
            <input type="radio" name="user_limb[]" id="user-limb2" value="2"><label>2</label>
            <input type="radio" name="user_limb[]" id="user-limb3" value="3"><label>3</label>
            <input type="radio" name="user_limb[]" id="user-limb4" value="4"><label>4</label>
          </div>
          <div class="user-superpower-select users-fields">
            <label>select your superpower*</label>
            <select name="superpowers[]" id="superpowers-select" multiple="multiple">
              <option value="invisibility">invisibility</option>
              <option value="flight">flight</option>
              <option value="immortality">immortality</option>
              <option value="man">man (all in one)</option>
            </select>
          </div>
          <div class="user-bio-field users-fields">
            <label>enter your biography*</label>
            <textarea placeholder="your biography" name="user_bio" id="user-bio" cols="20" rows="1"></textarea>
          </div>
          <div class="contract-checkbox users-fields">
            <input type="checkbox" name="accept_contract" id="accept-contract">
            <label>I accept the contract</label>
          </div>
          <div class="submit-button users-fields">
            <button id="submit-button" type="submit">submit</button>
          </div>
        </form>
      </div>
    </div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
  </div>