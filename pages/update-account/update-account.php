<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>update account</title>

    <link rel="stylesheet" href="../../hooks/form-style.css" />

    <link rel="stylesheet" href="../../index.css" />

    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <form action="">
      <h1 class="title">Update Account</h1>

      <div class="user-box">
        <input type="text" id="name" required />
        <label for="name" style="color: #212121">Name </label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <input type="text" id="username" required />
        <label for="username" style="color: #212121">Username </label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <input type="text" id="email" required />
        <label for="email" style="color: #212121">E-Mail </label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <input
          type="text"
          id="birthdate"
          required
          onfocus="(this.type = 'date')"
          onblur="if(!this.value)this.type ='text'"
        />
        <label for="birthdate" style="color: #212121">Birthdate </label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <input type="text" id="gender" required />
        <label for="gender" style="color: #212121">Gender </label>
        <br />
        <br />
      </div>
      <div class="user-box">
        <input type="file" id="profilePic" accept="image/*" />
        <label for="picture" style="color: #212121">Picture </label>
        <br />
        <br />
      </div>

      <input class="submit-btn" type="submit" value="Update" />

      <a href="../../index.html" class="close-form">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-16 h-16 cursor-pointer absolute right-5 top-5 close-profile"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
      </a>
    </form>
  </body>
</html>
