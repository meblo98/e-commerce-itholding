const API_URL = "https://jsonplaceholder.typicode.com/albums";

// Récupérer tous
/*
    API client helper

    Configurez BASE_API pour pointer vers votre back Laravel (ex: '/api')
    Pendant le développement local vous pouvez pointer vers les mocks créés
    dans `assets/mock` en mettant BASE_API = '/assets/mock' (voir exemples)

    Endpoints attendus côté Laravel (suggestion):
        GET  /api/categories         -> [{ id, name, description }]
        GET  /api/products           -> [{ id, title, description, image, price, brand_id, category_id }]
        GET  /api/products/:id       -> { id, title, description, image, price, brand_id, category_id }
        GET  /api/brands             -> [{ id, title, image }]

*/

const BASE_API = '/api'; // change to '/assets/mock' to use local mocks

async function getJson(url) {
    const res = await fetch(url, { cache: 'no-store' });
    if (!res.ok) throw new Error(`HTTP ${res.status} ${res.statusText}`);
    return res.json();
}

// Categories
export async function getCategories() {
    // if using mocks folder, the file will be categories.json
    const url = BASE_API.startsWith('/assets/mock') ? `${BASE_API}/categories.json` : `${BASE_API}/categories`;
    return getJson(url);
}

// Brands
export async function getBrands() {
    const url = BASE_API.startsWith('/assets/mock') ? `${BASE_API}/brands.json` : `${BASE_API}/brands`;
    return getJson(url);
}

// Products (list)
export async function getProducts() {
    const url = BASE_API.startsWith('/assets/mock') ? `${BASE_API}/products.json` : `${BASE_API}/products`;
    return getJson(url);
}

// Product by id
export async function getProduct(id) {
    if (!id) throw new Error('id required');
    const url = BASE_API.startsWith('/assets/mock') ? `${BASE_API}/products.json` : `${BASE_API}/products/${id}`;
    // when using mock file, filter locally
    const data = await getJson(url);
    if (Array.isArray(data)) {
        return data.find(p => String(p.id) === String(id)) || null;
    }
    return data;
}

// legacy helper (jsonplaceholder during earlier testing)
// export async function getPosts() {
//     return getProducts();
// }

// export async function getPost(id) {
//     return getProduct(id);
// }


export async function getPosts() {
    return getJson('https://jsonplaceholder.typicode.com/posts');
}

export async function getPost(id) {
    return getJson(`https://jsonplaceholder.typicode.com/posts/${id}`);
}
