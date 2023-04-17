const main = document.getElementById("main");

const getPosts = async () => {
  let xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    main.innerHTML = "<loading-spinner></loading-spinner>";
    if (this.readyState == 4 && this.status == 200) {
      main.innerHTML = "";
      const data = JSON.parse(this.responseText);

      if (data.data.length == 0) {
        main.innerHTML = `<h3 class="text-center mt-20">Tidak ada post!</h3>`;
        return;
      }
      for (let x of data.data) {
        let path = "./assets/user-black.png";
        if (x.profile_picture) {
          path = "./assets/uploads/" + x.profile_picture;
        }

        main.innerHTML += `
            <user-post id="${x.id}" 
                user-logo="${path}" 
                img="./assets/uploads/${x.image_url}" 
                description="${x.caption}" 
                name="${x.username}"
                ${x.liked ? "liked" : ""}
            </user-post>`;
      }
    }
  };

  xmlhttp.open(
    "GET",
    "http://localhost/tubes-web/tubes-web/api/post.php",
    true
  );
  xmlhttp.send();
};

const onLoadWeb = async () => {
  await getPosts();
  setTimeout(() => {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const newUser = urlParams.get("to");

    if (newUser) {
      location.href = "#" + newUser;
    }
  }, 500);
};

const btnClicked = () => {
  document.querySelector(".popup").remove();
};

const getCookie = (name) => {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(";").shift();
};
