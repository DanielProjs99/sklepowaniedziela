import React from 'react';
import ReactDOM from 'react-dom';

import thunkMiddleware from 'redux-thunk';

import { Provider } from 'react-redux';
import { createStore, applyMiddleware, compose } from 'redux';
import reducers from './reducers';

import Root from './containers/Root';

import { initialLoad } from './actions';

if (document.getElementById("front-map-app")) {

    const composeEnhancers = compose;

    const store = createStore(
        reducers, composeEnhancers(
            applyMiddleware(
            thunkMiddleware
        ))
    );
    
    store.dispatch(initialLoad());
    
    ReactDOM.render(
        <Provider store={store}>
            <Root />
        </Provider>,
        document.getElementById('front-map-app')
    );
}