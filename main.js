const getPosts = async () => {
  const res = await fetch("http://localhost/tubes-web/tubes-web/api/post.php");
  const data = await res.json();
};
