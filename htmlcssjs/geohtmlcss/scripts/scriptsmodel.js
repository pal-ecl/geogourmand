"use strict"



let geogourmand= geogourmand || {};

// on affiche la carte
(function (publics) {
    let privates={};
    privates.getData = function(){
        let xhr= new XMLHttpRequest()
        xhr.addEventListener("readystatechange", privates.onLoadProgress);
        //a voir comment on prend les infos sur le serveur
 //       xhr.open('GET','...')
        xhr.send();
    }

    privates.onLoadProgress= function (evt){
        console.log(this.readyState);
        if (this.readyState===4 && this.status===200) {
            //a voir comment on prend les infos sur le serveur
//            privates.initMap(JSON.parse(this.responseText));
        }
    }

    privates.initMap= function (){
        let map = new google.maps.Map(myMap, {zoom: 6, center : {lat:43.600000, lng:1.443333}});
        for (let specialite of specialites) {
            let marker= new google.maps.Marker({
                position:{
                    lat:specialite ,
                    lng:specialite
                },
                map:map
            });
        }
    }
    //on appelle la fonction,  
    privates.getData();
})() 