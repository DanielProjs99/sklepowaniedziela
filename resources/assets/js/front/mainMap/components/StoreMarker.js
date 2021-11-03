import React, { Component } from "react";

import { Marker, InfoWindow } from "react-google-maps";

class StoreMarker extends Component {
  constructor(props) {
    super(props);

    this.state = {
      visibleText: false
    };

    this.onToggleText = this.onToggleText.bind(this);
  }

  onToggleText() {
    this.setState({
      ...this.state,
      visibleText: !this.state.visibleText
    });
  }

  render() {
    let infoWindow = null;

    if (this.state.visibleText) {
      infoWindow = (
        <InfoWindow onCloseClick={this.onToggleText}>
          <div style={{
            maxWidth: "300px",
          }}>
              <h4>{this.props.name}</h4>
              <p>{this.props.street} {this.props.postCode} {this.props.city}</p>
              <span>Otwarte od: <b>{this.props.openFrom}</b> do: <b>{this.props.openTo}</b></span>
          </div>
        </InfoWindow>
      );
    }

    return (
      <Marker
        position={{
          lat: this.props.lat,
          lng: this.props.lng
        }}
        onClick={this.onToggleText}
      >
      {infoWindow}
      </Marker>
    );
  }
}

export default StoreMarker;
