import { ref } from 'vue'
import { useRoute,onBeforeRouteUpdate,useRouter } from 'vue-router'
import { useCookies } from '@vueuse/integrations/useCookies'

export function useTabList() {
    const route = useRoute()
    const router = useRouter()
    const cookie = useCookies()

    const activeTab = ref(route.path)
    // Tab List Object
    const tabList = ref(
        [
            {
                title: 'Dashboard',
                path: '/dashboard'
            }
        ])    

    // And Tabs
    function addTab(tab) {
        let noTab = tabList.value.findIndex(t => t.path == tab.path) == -1
        if(noTab) {
            tabList.value.push(tab)
        }

        cookie.set('tabList',tabList.value)
    }
    // The onBeforeRouteUpdate Will Execute When The Route Had Same Change
    onBeforeRouteUpdate((to,from)=>{
        // Set It Value As Destination Path
        activeTab.value = to.path
        // Import The title And path Of The Destination Path To addTab Function
        addTab({
            title: to.meta.title,
            path: to.path
        })
    })
    // Restore The Tab List
    function restoreTabList() {
        // Get The Tab List Data From Cookie
        let tabListData = cookie.get('tabList')
        // If Those Data Available, Restore It
        if(tabListData) {
            tabList.value = tabListData
        }
    } 

    restoreTabList()

    const changeTab = (t)=>{
        activeTab.value = t
        router.push(t)
    }
        
    const removeTab = (tabPath) => {
        // Get the list of tabs and the active tab
        let tabs = tabList.value
        let activeTabPath = activeTab.value
        // If the tab to be removed is the active tab, set the active tab to the next tab in the list
        if (activeTabPath == tabPath) {
            tabs.forEach((tab, index) => {
            if (tab.path == tabPath) {
                const nextTab = tabs[index + 1] || tabs[index - 1]
                if (nextTab) {
                activeTabPath = nextTab.path
                }
            }
            });
        }
        // Update the active tab and remove the tab from the list
        activeTab.value = activeTabPath
        tabList.value = tabList.value.filter(tab => tab.path != tabPath)
        cookie.set('tabList', tabList.value)
    }

    const handleClear = (c)=>{
        if(c == 'clearAll') {
            activeTab.value = '/dashboard'
            tabList.value = [
                {
                    title: 'Dashboard',
                    path: '/dashboard'
                }
            ]
        }
        else if(c == 'clearOther') {
            tabList.value = tabList.value.filter(tab => tab.path == '/dashboard' || tab.path == activeTab.value)
        }
        cookie.set('tabList',tabList.value)
    }

    return {
        activeTab,
        tabList,
        changeTab,
        removeTab,
        handleClear
    }
}