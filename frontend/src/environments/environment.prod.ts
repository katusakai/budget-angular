import * as env from 'src/environments/env';
export const environment = {
  production:          true,
  appName:             'KickStarter',
  backendUri:          '/api',
  GoogleOAuthClientId: env.env.GOOGLE_OAUTH_CLIENT_ID,
  FacebookAppId:       env.env.FACEBOOK_APP_ID
};
