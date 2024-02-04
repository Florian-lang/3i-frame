const routes = require('./config/routes.json');

class Router {
    /**
     * @param {string} name
     * @return {string}
     */
    generate(name) {
        for (let url in routes) {
            if (data[url]["name"] === name) {
                return url;
            }
        }

        console.log(`Router: route not found ${name}, did you add your route in the config/routes.json file ?`);
        return '#';
    }
}
export default new Router();
