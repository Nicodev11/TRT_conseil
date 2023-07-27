import './styles/app.scss';

console.log('Hello Webpack Encore! Edit me in assets/app.js');

const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#inputPassword");

togglePassword.addEventListener("click", () => {

  const type = password.getAttribute("type") === "password" ? "text" : "password";

  password.setAttribute("type", type);

  if (type === 'text') {
    togglePassword.classList = "bi-eye"
  } else {
    togglePassword.classList = "bi-eye-slash"
  }
});