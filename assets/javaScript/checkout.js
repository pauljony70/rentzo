const btnNext = document.getElementById("checkOutNext");
const addressTab = document.getElementById("address-tab");
const addressC = document.getElementById("address");
const paymentTab = document.getElementById("payment-tab");
const paymentC = document.getElementById("payment");

if (btnNext && addressTab && addressC && paymentTab && paymentC) {
  btnNext.addEventListener("click", () => {
    addressTab.classList.remove("active");
    addressC.classList.remove("active");
    addressC.classList.remove("show");
    paymentTab.classList.add("active");
    paymentC.classList.add("active");
    paymentC.classList.add("show");
  });
}
