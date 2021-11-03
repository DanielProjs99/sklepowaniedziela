import { combineReducers } from 'redux'

import view from './view';
import sundays from './sundays';

const reducers = combineReducers({
    sundays,
    view
})

export default reducers;