console.log("Le script company.js est chargé !");

const city = document.getElementById("company_city");
const zipCode = document.getElementById("company_zip");

zipCode.addEventListener("change", function () {
    let zipCodeValue = zipCode.value;

    axios("http://api.zippopotam.us/FR/" + zipCodeValue)
      .then(datas => {

        let cityValue = datas.data.places;
        let cityLength = cityValue.length;

        city.innerHTML = "";

        for (let i = 0; i < cityLength; i++) {
          let option = document.createElement("option");
            option.value = cityValue[i]["place name"];
            option.textContent = cityValue[i]["place name"];
          city.appendChild(option);
        }
        
      }).catch(error => {

        city.innerHTML = "";

        let option = document.createElement("option");
        option.value = "Veuillez renseigner un code postal valide";
        option.text = "Veuillez renseigner un code postal valide";
        city.appendChild(option);
      })
});