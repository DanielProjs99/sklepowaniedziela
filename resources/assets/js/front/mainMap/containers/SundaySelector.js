import { connect } from "react-redux";
import Selector from "../components/Selector";
import { changeVisibleSunday } from "../actions";


const mapStateToProps = state => {
  return {
    sundays: state.sundays.sundays,
    selected: state.view.selectedSunday
  };
};

const mapDispatchToProps = dispatch => ({
  onSundayChange: (id) =>
    dispatch(changeVisibleSunday(id))
});

const SundaySelector = connect(
  mapStateToProps,
  mapDispatchToProps
)(Selector);

export default SundaySelector;
