import { connect } from 'react-redux';
import App from '../components/App';

const mapStateToProps = state => {
    return {
        loadingData: state.sundays.loading,
        isNextSunday: state.sundays.isNextSunday,
        isTodaySunday: state.sundays.isTodaySunday,
        isTodayNt: state.sundays.isTodayNt,
        loadingDataFailed: state.sundays.error,
        currentSunday: state.sundays.loading ? null : state.sundays.sundays.filter(sunday => {
            if (sunday.id == state.view.selectedSunday) {
                return true;
            }
            else {
                return false;
            }
        })[0]
    }
}

const Root = connect(
    mapStateToProps,
)(App);

export default Root;