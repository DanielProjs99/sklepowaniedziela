export const REQUESTING_DATA = 'REQUESTING_DATA';
function requestingData() {
    return {
        type: REQUESTING_DATA
    }
}

export const RECEIVED_DATA = 'RECEIVED_DATA';
function receivedData(data) {
    return {
        type: RECEIVED_DATA,
        data: data
    }
}

export const RECEIVING_DATA_FAILED = 'RECEIVING_DATA_FAILED';
function receivingDataFailed() {
    return {
        type: RECEIVING_DATA_FAILED
    }
}

export function fetchData() {
    return function (dispatch) {
        dispatch(requestingData());

        return window.axios.get("/json")
            .then(
                response => dispatch(receivedData(response.data)),

                error => dispatch(receivingDataFailed())
            )
    }
}

export function initialLoad() {
    return function (dispatch) {
        dispatch(fetchData());
    }
}

export const CHANGE_VISIBLE_SUNDAY = "CHANGE_VISIBLE_SUNDAY";
export function changeVisibleSunday(id) {
    return {
        type: CHANGE_VISIBLE_SUNDAY,
        id
    }
}