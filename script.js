
document.addEventListener("DOMContentLoaded", function() {
    const services = document.querySelectorAll(".service");
    
    services.forEach(service => {
        service.addEventListener("click", function() {
            alert(`You selected the ${service.querySelector("h3").textContent} service.`);
        });
    });
});
