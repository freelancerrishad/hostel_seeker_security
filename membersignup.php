
<!--  akwgbxdwqpbcsyzs -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Member signup</title>
    <link rel="stylesheet" type="text/css" href="css/ownersignup.css">
  </head>
  <body>
    <div>

    </div>
    <div class="home">
      <h1><a href="index.php">Back To Home</a></h1>
    </div>
    <div class="member_signup_container">
      <div class="member_signup_header">
        <h2>Member Registration Form</h2>
      </div>
      <form class="member_form" action="membersignup2.php" method="post">
        
        <div class="input-form">
          <label for="username" class="username">Username:</label>
          <input type="username" name="username" id="username" class="input" placeholder="Enter a username" required>
        </div>

        <div>
        <label for="name" class="name">Name:</label>
          <input type="name" name="name" id="name" class="input" placeholder="Enter your full name" required>
        </div>

        <div>
        <label for="email" class="email">Email:</label>
          <input type="email" name="email" id="email" class="input" placeholder="Enter your email" required>  
        </div>
        
        <div>
        <label for="mobile_num" class="mobile_num">Mobile_num:</label>
          <input type="mobile_num" name="mobile_num" id="mobile_num" class="input" placeholder="Enter your mobile_num" required>
        </div>

        <div>
        <label for="profession" class="profession">Profession:</label>
          <input type="profession" name="profession" id="profession" class="input" placeholder="Enter your profession" required>
        </div>

        <div>
        <label for="age" class="age">Age:</label>
          <input type="age" name="age" id="age" class="input" placeholder="Enter your age" required>
        </div>
       
        <div>
        <label for="nid" class="nid">NID:</label>
          <input type="nid" name="nid" id="nid" class="input" placeholder="Enter your nid" required>
        </div>

        <div>
        <label for="gender" class="gender">Gender:</label>
          <input type="gender" name="gender" id="gender" class="input" placeholder="Enter your gender" required>
        </div>

        <div>
        <label for="address" class="address">Address:</label>
          <input type="address" name="address" id="address" class="input" placeholder="Enter your address" required>
        </div>
       
        <div>
        <label for="password" class="password">Password:</label>
          <input type="password" name="password" id="password" class="input" placeholder="Enter your password" required>
        </div>
      
       
        <button type="submit" name="submit">Submit</button>
        <div class="already">Already a user &nbsp;&nbsp; <a href="index.php">LogIn</a></div>
      </form>
    </div>
  </body>
</html>
