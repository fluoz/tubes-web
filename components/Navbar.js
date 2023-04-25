class Navbar extends HTMLElement {
  constructor() {
    super();
    this.isLogin = this.getCookie("login");
    this.path = this.getAttribute("specific-path");
  }

  connectedCallback() {
    this.render();
    this.querySelector(".clicked").addEventListener("click", () =>
      this.openProfileHandler()
    );
  }

  openProfileHandler = () => {
    document.querySelector("#sidebar").innerHTML = `<side-bar 
    username=${this.getCookie("username")}
    path=${this.path + "pages/"}
    profileLogo=${
      this.getCookie("profile_picture")
        ? this.path + "assets/uploads/" + this.getCookie("profile_picture")
        : this.path + "assets/user-black.png"
    }></side-bar>`;
  };

  getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
  }

  render() {
    let right = `
        <a class="px-8 rounded-md bg-white py-3 flex items-center justify-center text-black bold text-lg" href="${this.path}/pages/sign-in/signIn.php">Login</a>
      `;

    if (this.isLogin) {
      right = `
            <div
            class="flex items-center cursor-pointer clicked"
          >
            <h1 class="text-white text-xl mr-4 font-bold">${this.getCookie(
              "username"
            )}</h1>
            <img width="55" class="rounded-full max-h-[55px]" src=${
              this.getCookie("profile_picture")
                ? this.path +
                  "assets/uploads/" +
                  this.getCookie("profile_picture")
                : this.path + "assets/user.png"
            } alt="" />
          </div>
        `;
    }

    this.innerHTML = `
    <nav
      class="w-full top-0 sticky bg-[#393536] border-b-4 border items-center border-black flex justify-between px-8"
    >
    <a href="${this.path + "index.html"}">
      <img width="130" src=${this.getAttribute("logo")} alt="" />
      </a>
    ${right}
    </nav>
    <div id="sidebar"></div>
    `;
  }
}

window.customElements.define("my-navbar", Navbar);
