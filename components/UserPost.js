class UserPost extends HTMLElement {
  constructor() {
    super();
    this.id = this.getAttribute("id");
    this.liked = this.hasAttribute("liked");
    this.isLogin = this.getCookie("login");
    this.countLikes = parseInt(this.getAttribute("count-likes"))
  }
  connectedCallback() {
    this.render();
    this.querySelector(".view-click").addEventListener("click", () => {
      this.openPopupComment();
    });

    this.querySelector(".like-click").addEventListener("click", () => {
      this.onLikeHandler();
    });

    this.querySelector(".trash").addEventListener("click", () => {
      this.deletePost();
    });
  }

  openPopupComment() {
    location.href = `pages/view-comments/view-comments.php?id=${this.id}`;
  }

  getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
  }

  async onLikeHandler() {
    if (!this.isLogin) {
      document.querySelector("#portal").innerHTML = `
        <div style="z-index: 999;" class="popup open-popup" id="popup">
        <h2>Error!</h2>
        <p>Tolong Login dlu!</p>
        <button onclick="btnClicked()" type="button">Ok</button>
      </div>
      `;
      return;
    }

    this.liked = !this.liked;

    const post = {
      username: this.getCookie("username"),
      post_id: this.id,
    };

    let xmlhttp = new XMLHttpRequest();
    if (this.liked) {
      this.querySelector(".svg-like").style.fill = "red";
      this.querySelector(".likes-count").innerHTML = ++this.countLikes;
      xmlhttp.open(
        "POST",
        "http://localhost/tubes-web/tubes-web/api/likes.php"
      );
      xmlhttp.setRequestHeader("Content-Type", "application/json");
      xmlhttp.send(JSON.stringify(post));
    } else {
      this.querySelector(".svg-like").style.fill = "none";
      this.querySelector(".likes-count").innerHTML = --this.countLikes;
      xmlhttp.open(
        "DELETE",
        "http://localhost/tubes-web/tubes-web/api/likes.php"
      );
      xmlhttp.setRequestHeader("Content-Type", "application/json");
      xmlhttp.send(JSON.stringify(post));
    }
  }

  async deletePost() {
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.open("DELETE", "http://localhost/tubes-web/tubes-web/api/post.php");
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify({ post_id: this.id }));
    this.remove();
  }

  render() {
    this.innerHTML = `
    <section class="mt-20 border border-4 bg-white max-w-[600px] mx-auto border-black">
    <div class="flex justify-between border-b-4 border-black items-center px-6 py-2">
    <a href="./pages/user-profile/user-profile.php?username=${this.getAttribute("name")}">
      <div class="flex items-center">
          <img width="60" class="rounded-full max-h-[60px]" src=${this.getAttribute(
            "user-logo"
          )} alt="" />
          <h2 class="text-xl ml-4">${this.getAttribute("name")}</h2>
        </div>
      </a>
      ${
        this.getCookie("username") == this.getAttribute("name")
          ? `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" class="w-6 h-6 trash cursor-pointer">
      <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
    </svg>
    `
          : ""
      }
    </div>
    <div class="w-full border-b-4 border-black ">
      <div class="aspect-w-3 aspect-h-4">
        <img src="${this.getAttribute(
          "img"
        )}" class="object-cover object-center h-full w-full" alt="">
      </div>
    </div>
    <div class="px-6 py-6">
      <div class="flex">
        <div class="flex cursor-pointer flex-col items-center">
        <div class="like-click flex items-center flex-col">
          <svg xmlns="http://www.w3.org/2000/svg" fill="${
            this.liked ? "red" : "none"
          }" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 svg-like">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z"
            />
          </svg>
          <p class="likes-count">${this.countLikes}</p>
          <p class="mt-2">Like</p>
          </div>
          <a class="mt-4 underline" href="pages/view-likes/view-likes.php?id=${
            this.id
          }">View Likes</a>
          </div>
        <div class="ml-8 view-click cursor-pointer flex flex-col items-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"
          />
          </svg>
          <p class="mt-2">View Comments</p>
        </div>
      </div>
      <p class="py-6">${this.getAttribute("description")}</p>
    </div>
  </section>
        `;
  }
}

window.customElements.define("user-post", UserPost);
