import React from "react";

import TNMAP from "./Map";
import SundaySelector from "../containers/SundaySelector";

const App = ({
  loadingData,
  loadingDataFailed,
  currentSunday,
  isNextSunday,
  isTodaySunday,
  isTodayNt
}) => {
  if (!loadingData && !loadingDataFailed) {
    console.log(isTodayNt);
    return (
      <div>
        <TNMAP
          googleMapURL="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG_-m4Daip1DVfQDhL2KjErgLoBpu1qGI&v=3.exp&libraries=geometry,drawing,places"
          loadingElement={<div style={{ height: `100%` }} />}
          containerElement={<div style={{ height: `400px` }} />}
          mapElement={<div style={{ height: `100%` }} />}
          stores={currentSunday.reservations}
        />
        <SundaySelector />
        <div className="px-2">
          {isTodaySunday ? (
            isTodayNt ? (
              <div>
                <h2
                  className="text-center text-danger mt-2"
                  style={{ fontSize: "30px" }}
                >
                  Dzisiaj jest niedziela niehandlowa
                </h2>
                <h4 className="mt-3 text-center">
                  Otwarte sklepy w Twojej okolicy możesz zobaczyć na mapie
                  powyżej.
                </h4>
              </div>
            ) : (
              <div>
                <h2
                  className="text-center text-success mt-2"
                  style={{ fontSize: "30px" }}
                >
                  Dzisiaj jest niedziela handlowa
                </h2>
                <h4 className="mt-3 text-center">
                  Otwarte sklepy w przyszłe dni niehandlowe możesz
                  zobaczyć na mapie powyżej.
                </h4>
              </div>
            )
          ) : isNextSunday ? (
            <div>
              <h2
                className="text-center text-danger mt-2"
                style={{ fontSize: "30px" }}
              >
                Następna niedziela jest niehandlowa
              </h2>
              <h4 className="mt-3 text-center">
                Otwarte sklepy w Twojej okolicy możesz zobaczyć na mapie
                powyżej.
              </h4>
            </div>
          ) : (
            <div>
              <h2
                className="text-center text-success mt-2"
                style={{ fontSize: "30px" }}
              >
                Następna niedziela jest handlowa
              </h2>
              <h4 className="mt-3 text-center">
                Otwarte sklepy w przyszłe dni niehandlowe możesz zobaczyć
                na mapie powyżej.
              </h4>
            </div>
          )}
        </div>
      </div>
    );
  } else if (loadingDataFailed) {
    return <p>Wystąpił błąd, odśwież stronę.</p>;
  } else {
    return <p>Ładowanie</p>;
  }
};

export default App;
