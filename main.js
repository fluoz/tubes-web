const main = document.getElementById("main");
// let postData = [];

const getPosts = async () => {
  const res = await fetch("http://localhost/tubes-web/tubes-web/api/post.php");
  const data = await res.json();
  let postData = data.data;

  if (postData.length == 0) {
    main.innerHTML = `<h3>Tidak ada post!</h3>`;
  }

  for (let x of postData) {
    let path = "./assets/user-black.png";
    if (x.profile_picture) {
      path = "./assets/uploads/" + x.profile_picture;
    }

    main.innerHTML += `
        <user-post id="${x.id}" 
            user-logo="${path}" 
            img="./assets/uploads/${x.image_url}" 
            description="${x.caption}" 
            name="${x.username}">
        </user-post`;
  }
};

const onLoadWeb = async () => {
  await getPosts();
  await new Promise((r) => setTimeout(r, 1000));
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const newUser = urlParams.get("to");

  if (newUser) {
    location.href = "#" + newUser;
  }
};
