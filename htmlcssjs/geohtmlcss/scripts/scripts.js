"use strict"



let geogourmand;
geogourmand = geogourmand || {};
let publics = 'vendor/nuke.json';

// on affiche la carte
(function (publics) {
    let privates={};
    privates.getData = function(){
        let xhr= new XMLHttpRequest()
        xhr.addEventListener("load", privates.onDataLoaded);
        //a voir comment on prend les infos sur le serveur
        xhr.open('GET', publics);
        xhr.send();
    }

    privates.onDataLoaded = function (evt) {
        privates.nukeData = JSON.parse(this.responseText);
        privates.initMap();
    }

    privates.initMap = function (){
        let mapContainer = document.querySelector('#myMap');
        privates.map = new google.maps.Map(mapContainer, {
            zoom: 8,
             center : {
                 lat:43.600000,
                  lng:1.443333
                }
        });
        let specialties = privates.getSpecialties();
        privates.initMarkers(specialties);
    }

    privates.initMarkers = function (specialties){
        for (let specialty of specialties){
            let marker = new google.maps.Marker({
                position: {
                    lat: specialty.position['lat'],
                    lng: specialty.position['long']
                },
                icon: 'vendor/mou.png',
                map: privates.map
            })
        }
    }

    privates.getSpecialties = function() {
        let specialties = [];
        outer: for (let reacteur of privates.nukeData){
            for (let specialty of specialties) {
                if (specialty.name == reacteur["Centrale nucléaire"]){
                    continue outer;
                }
            }
            specialties.push({
                name: reacteur["Centrale nucléaire"],
                position :{
                    lat: reacteur["Commune Lat"],
                    long: reacteur["Commune long"],
                }
            });
        }
        return specialties;
    }

    //on appelle la fonction,  
    privates.getData();
})(publics) 