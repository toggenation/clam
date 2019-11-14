import {  createStore, compose, applyMiddleware } from "redux";
import thunk from "redux-thunk";
import initialState from "./initialState";
import { batchDispatchMiddleware } from "redux-batched-actions";
import { createLogger } from "redux-logger";
import { createRouteReducer } from './reducers/rootReducer';
import { createBrowserHistory } from "history";
import { routerMiddleware } from "connected-react-router";

export const history = createBrowserHistory();
let logger = createLogger();

let middleware = [thunk, batchDispatchMiddleware];

if (typeof window !== "undefined" && process.env.NODE_ENV !== "production") {
    middleware = [...middleware, logger];
}

const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;

const store = createStore(
    createRouteReducer(history),
    initialState,
    composeEnhancers(applyMiddleware(routerMiddleware(history), ...middleware))
);

export default store;
