import React, { Component } from "react";

import {
  withScriptjs,
  withGoogleMap,
  GoogleMap,
  Marker,
  InfoWindow
} from "react-google-maps";

import StoreMarker from "./StoreMarker";

class TNMap extends Component {
  constructor(props) {
    super(props);

    this.state = {
      centerLat: 52.404626,
      centerLng: 16.924184
    };
  }

  render() {
    return (
      <GoogleMap
        zoom={11}
        defaultCenter={{ lat: this.state.centerLat, lng: this.state.centerLng }}
        defaultOptions={{
          styles: [
            {
              featureType: "poi.business",
              stylers: [
                {
                  visibility: "off"
                }
              ]
            }
          ],
          streetViewControl: false,
        }}
      >
        {this.props.stores
          ? this.props.stores.map(store => {
              return (
                <StoreMarker
                  key={store.id}
                  lat={Number(store.lat)}
                  lng={Number(store.lng)}
                  name={store.full_name}
                  postCode={store.post_code}
                  street={store.street}
                  city={store.city}
                  openFrom={store.time_from}
                  openTo={store.time_to}
                />
              );
            })
          : null}
      </GoogleMap>
    );
  }
}

export default withScriptjs(withGoogleMap(TNMap));
