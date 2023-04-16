class SideBar extends HTMLElement {
  constructor() {
    super();
    this.profileLogo = this.getAttribute("profileLogo");
    this.path = this.getAttribute("path");
  }

  connectedCallback() {
    this.render();
    this.querySelector(".close-profile").addEventListener("click", () =>
      this.closeProfileHandler()
    );
    this.querySelector(".btn-logout").addEventListener("click", () => {
      document.cookie =
        "login=;path=/tubes-web;expires=Thu, 01 Jan 1970 00:00:01 GMT";
      location.href = this.path + "sign-in/signIn.php";
    });
  }

  closeProfileHandler = () => {
    const profile = document.querySelector(".show-profile");
    profile.classList.add("translate-x-full");
    profile.addEventListener("transitionend", (e) => {
      this.remove();
    });
  };

  getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
  }

  render() {
    this.innerHTML = `
        <div
      class="show-profile transition-all duration-500 ease-in-out fixed w-[500px] rounded-tl-[40px] rounded-bl-[40px] border border-black border-4 py-12 px-12 h-screen right-0 top-0 bg-[#F1F1F1]"
    >
      <div class="relative w-full">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-16 h-16 cursor-pointer absolute left-0 top-0 close-profile"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
      </div>
      <img class="mx-auto mt-20 w-32" src="${this.profileLogo}" alt="" />
      <h1 class="text-center font-bold text-4xl my-8">Username</h1>
      <ul class="mx-auto w-full">
        <li
          class="w-full cursor-pointer mt-6 bg-white font-bold text-2xl border border-black border-4 rounded-full text-center"
        >
          <a class="w-full block py-3 h-full" href="${this.path}update-account/update-account.php">Update Account</a>
        </li>
        <li
          class="w-full cursor-pointer mt-6 bg-white font-bold text-2xl border border-black border-4 rounded-full text-center"
        >
          <a class="w-full block py-3 h-full" href="${this.path}change-password/change-password.php">Change Password</a>
        </li>
        <li
          class="w-full cursor-pointer mt-6 bg-white font-bold text-2xl border border-black border-4 rounded-full text-center"
        >
          <a class="w-full block py-3 h-full" href="${this.path}add-post/add-post.php">Upload Content</a>
        </li>
      </ul>

      <button
        class="w-full btn-logout text-center py-3 mt-8 bg-black text-white font-bold text-2xl rounded-full"
      >
        Log out
      </button>
    </div>
        `;
  }
}

window.customElements.define("side-bar", SideBar);
