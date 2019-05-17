"use strict"

let publics;



let geogourmand;
geogourmand = geogourmand || {};


// on affiche la carte
(function () {
    let privates={};

    privates.getData = function() {
        document.addEventListener('DOMContentLoaded', function () {
            let specialtiesToDisplay = document.querySelector('main');
            publics = specialtiesToDisplay.dataset.specialties;
            console.log(publics)
            privates.onDataLoaded(publics);
        });
    }

    privates.onDataLoaded = function (evt) {
        privates.specialtyData = JSON.parse(evt);
        console.log(privates.specialtyData);
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
                icon: 'images/mou.png',
                map: privates.map
            })
        }
    }

    privates.getSpecialties = function() {
        let specialties = [];
        for (let specialty of privates.specialtyData){
            specialties.push({
                name: specialty["title"],
                position :{
                    lat: parseFloat(specialty["latitude"]),
                    long: parseFloat(specialty["longitude"])
                }
            });
        }
        console.log(specialties);
        return specialties;
    }

    //on appelle la fonction,  
    privates.getData();
})(publics) 