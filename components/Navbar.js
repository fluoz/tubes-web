class Navbar extends HTMLElement {
  constructor() {
    super();
    this.profileLogo = this.getAttribute("profileLogo");
    this.isLogin = this.getCookie("login");
  }

  connectedCallback() {
    this.render();
    this.querySelector(".clicked").addEventListener("click", () =>
      this.openProfileHandler()
    );
  }

  openProfileHandler = () => {
    document.querySelector(
      "#sidebar"
    ).innerHTML = `<side-bar path=${this.getAttribute(
      "specific-path"
    )} profileLogo=${this.profileLogo}></side-bar>`;
  };

  getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
  }

  render() {
    this.innerHTML = `
    <nav
      class="w-full top-0 sticky bg-[#393536] border-b-4 border items-center border-black flex justify-between px-8"
    >
    <a href="index.html">
      <img width="130" src=${this.getAttribute("logo")} alt="" />
      </a>
      ${
        this.isLogin
          ? `<div
      class="flex items-center cursor-pointer clicked"
    >
      <h1 class="text-white text-xl mr-4 font-bold">Username</h1>
      <img width="55" src=${this.getAttribute("userImg")} alt="" />
    </div>`
          : `<a class="px-8 rounded-md bg-white py-3 flex items-center justify-center text-black bold text-lg" href="${this.getAttribute(
              "specific-path"
            )}sign-in/signIn.php">Login</a>`
      }
    </nav>
    <div id="sidebar"></div>
    `;
  }
}

window.customElements.define("my-navbar", Navbar);
