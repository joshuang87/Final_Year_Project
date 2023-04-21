import { ElNotification,ElMessageBox } from "element-plus";
import nProgress from "nprogress";

// Display A Notification
export function notification(title,message,type) {
    ElNotification({
        title,
        message,
        type,
        duration: 3000
    })
}

// Display A Message Box
export function messageBox(message,title,type) {
    return ElMessageBox.confirm(
            message,
            title,
            {
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            type
            }
        )
}

// Show Loading Animation
export function showFullLoading() {
    nProgress.start()
}

// End Loading Animation
export function hideFullLoading() {
    nProgress.done()
}