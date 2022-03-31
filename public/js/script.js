const scrollBtn = document.querySelector(".scroll-to-top");

console.log(scrollBtn);

const refreshButtonVisibility = () =>{
    if (document.documentElement.scrollTop <= 150){
        scrollBtn.style.display = "none";
    }else{
        scrollBtn.style.display = "block";
    }

};
refreshButtonVisibility();

scrollBtn.addEventListener("click", () => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;

    scroll({
        top: offsetTop,
        behavior: "smooth"
      });
});

document.addEventListener("scroll",(e) => {
    refreshButtonVisibility();

});