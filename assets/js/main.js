const btnGeo = document.getElementById("btn-geo");
const cordonnee = document.getElementById("cordonnee");

console.log(btnGeo, cordonnee);


btnGeo.addEventListener("click",
    () => navigator.geolocation.getCurrentPosition(
        position => {
            cordonnee.value = `${position.coords.latitude + position.coords.longitude}`;
        }
        )
)