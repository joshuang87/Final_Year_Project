import { useCookies } from "@vueuse/integrations/useCookies";

// Token Name
const TokenKey = 'admin-token'
const cookie = useCookies()

// Get Token With TokenKey
export function getToken() {
    return cookie.get(TokenKey)
}

// Set Token With TokenKey
export function setToken(token) {
    return cookie.set(TokenKey,token)
}

// Remove Token With TokenKey
export function removeToken() {
    return cookie.remove(TokenKey)
}