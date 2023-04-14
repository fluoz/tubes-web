class Navbar extends HTMLElement {
  constructor() {
    super();
    this.profileLogo = this.getAttribute("profileLogo");
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
    ).innerHTML = `<side-bar profileLogo=${this.profileLogo}></side-bar>`;
  };

  render() {
    this.innerHTML = `
    <nav
      class="w-full bg-[#393536] border-b-4 border border-black flex justify-between px-8"
    >
    <a href="index.html">
      <img width="130" src=${this.getAttribute("logo")} alt="" />
      </a>
      <div
        class="flex items-center cursor-pointer clicked"
      >
        <h1 class="text-white text-xl mr-4 font-bold">Username</h1>
        <img width="55" src=${this.getAttribute("userImg")} alt="" />
      </div>
    </nav>
    <div id="sidebar"></div>
    `;
  }
}

window.customElements.define("my-navbar", Navbar);
