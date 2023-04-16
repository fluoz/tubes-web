class Skeleton extends HTMLElement {
  constructor() {
    super();
  }
  connectedCallback() {
    this.render();
  }

  render() {
    this.innerHTML = `
  <section class="mt-20 border border-4 bg-white max-w-[600px] mx-auto border-black">
    <div class="flex border-b-4 border-black items-center px-6 py-2">
      <div class="w-1/6">
        <div class="aspect-w-1 aspect-h-1">
          <div class="animate-pulse bg-gray-200 rounded-full w-full"></div>
        </div>
      </div>
      <div class="ml-4 w-1/2">
        <div class="animate-pulse bg-gray-200 h-4 rounded w-full"></div>
        <div class="mt-2 animate-pulse bg-gray-200 h-4 rounded w-3/4"></div>
      </div>
    </div>
    <div class="w-full border-b-4 border-black">
      <div class="aspect-w-3 aspect-h-4">
        <div class="animate-pulse bg-gray-200 rounded-lg w-full"></div>
      </div>
    </div>
    <div class="px-6 py-6">
      <div class="flex">
        <div class="flex cursor-pointer flex-col items-center">
          <div class="like-click flex items-center flex-col">
            <div class="animate-pulse bg-gray-200 rounded-full w-12 h-12"></div>
            <div class="mt-2 animate-pulse bg-gray-200 h-4 rounded w-1/2"></div>
          </div>
          <a class="mt-4 underline" href="#">
            <div class="animate-pulse bg-gray-200 h-4 rounded w-1/2"></div>
          </a>
        </div>
        <div class="ml-8 view-click cursor-pointer flex flex-col items-center">
          <div class="animate-pulse bg-gray-200 rounded-full w-12 h-12"></div>
          <div class="mt-2 animate-pulse bg-gray-200 h-4 rounded w-1/2"></div>
        </div>
      </div>
    </div>
  </section>
          `;
  }
}

window.customElements.define("skeleton-post", Skeleton);
