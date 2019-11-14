import "react-app-polyfill/ie9";

import { ConnectedRouter } from "connected-react-router";

import React from "react";
import ReactDOM from "react-dom";
import './Styles/disabled.css';
import Root from "./Components/Root";
import { Provider } from "react-redux";
import store, { history } from "./Redux/store";
import { setApiUrl } from "./Redux/actions/actionCreators";
import "moment/locale/en-au";

const root = document.getElementById("root");
let API_URL = root.getAttribute("baseurl");

if (
    window.location.hostname !== "localhost" &&
    process.env.NODE_ENV !== "production"
) {
    console.log("API_URL", "http://10.19.73.30/api");
    API_URL = "http://10.19.73.30/api";
}

store.dispatch(setApiUrl(API_URL));

ReactDOM.render(
    <Provider store={store}>
        <ConnectedRouter history={history}>
            <Root />
        </ConnectedRouter>
    </Provider>,
    root
);
