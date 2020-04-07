import * as env from 'src/environments/env';
export const environment = {
  production:          true,
  appName:             'KickStarter',
  backendUri:          location.protocol + '//'+ location.hostname + ':' + env.env.API_PORT + '/api',
  GoogleOAuthClientId: env.env.GOOGLE_OAUTH_CLIENT_ID,
  FacebookAppId:       env.env.FACEBOOK_APP_ID
};
