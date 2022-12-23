import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useMarkets() {
    const markets = ref([])
    const market = ref([])
    const router = useRouter()
    const errors = ref('')

    const getMarkets = async () => {
        let response = await axios.get('/api/v1/markets')
        markets.value = response.data.data;
    }

    const getMarket = async (id) => {
        let response = await axios.get('/api/v1/markets/' + id)
        market.value = response.data.data;
    }

    const storeMarket = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/v1/markets', data)
            await router.push({name: 'markets.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateMarket = async (id) => {
        errors.value = ''
        try {
            await axios.put('/api/v1/markets/' + id + '?_method=PUT', market.value)
            await router.push({name: 'markets.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyMarket = async (id) => {
        await axios.delete('/api/v1/markets/' + id)
    }


    return {
        markets,
        market,
        errors,
        getMarkets,
        getMarket,
        storeMarket,
        updateMarket,
        destroyMarket
    }
}
