import { fetchStart } from "../Redux/actions/actionCreators";
import uuid from 'uuid/v4'
import moment from 'moment'

const handleErrors = response => {
    //console.log(response.status + ' ' + response.statusText)
    if (response.ok) {
        return response.json()
    }
    return response.json().then(err => Promise.reject(err))
};

const utils = {
    isEmptyObject: obj => {
        return Object.keys(obj).length === 0 && obj.constructor === Object
    },
    stringDateToDate: ( strDate ) => {
        return moment(strDate).toDate()
    },
    formatDate: (strDate, outputFormat = 'YYYY-MM-DD') => {
        return moment(strDate).format(outputFormat)
    },
    getUUID: () => uuid(),
    fetchFromCake: dispatch => {
        return (url, method = "GET", data = null) => {
            dispatch(fetchStart());
            let init = {
                method: method,
                mode: "cors",
                credentials: "include",
                headers: {
                    Accept: "application/json",
                    "Content-type": "application/json"
                }
            };
            if (data) {
                init.body = JSON.stringify(data);
            }
            //console.log("fetch start", url);
            return fetch(url, init)
                .then(handleErrors)
        };
    },
    flattenObject: ob => {
        var toReturn = {};

        for (var i in ob) {
            if (!ob.hasOwnProperty(i)) continue;

            if (typeof ob[i] === "object" && ob[i] !== null) {
                var flatObject = utils.flattenObject(ob[i]);
                for (var x in flatObject) {
                    if (!flatObject.hasOwnProperty(x)) continue;

                    toReturn[i + "." + x] = flatObject[x];
                }
            } else {
                toReturn[i] = ob[i];
            }
        }
        return toReturn;
    }
};

export default utils;
