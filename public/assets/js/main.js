import { getPosts, getPost } from "./api.js";

// container where products will be injected
const productRow = document.getElementById('product-one-row');

function truncateWords(text, count) {
    if (!text) return '';
    const words = text.split(/\s+/).filter(Boolean);
    if (words.length <= count) return words.join(' ');
    return words.slice(0, count).join(' ') + '...';
}

function escapeHtml(s) {
    return String(s).replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

function createProductHTML(post) {
    const id = post.id || 0;
    const title = escapeHtml(post.title || 'Produit');
    const body = escapeHtml(truncateWords(post.body || '', 3));
    const img = 'assets/img/slider/bg-3.jpeg';

    // Include a short description (3 words) and a Voir détails link with id
    return `
    <div class="col-sm-4 col-md-3 col-lg-2">
        <div class="xc-product-one__item">
            <a href="product-details.html?id=${id}">
                <img src="${img}" alt="product">
            </a>
            <h4 class="xc-product-one__title">
                <a href="product-details.html?id=${id}">${title}</a>
            </h4>
        </div>
    </div>`;
}

function renderProducts(container, posts) {
    try {
        const html = posts.map(p => createProductHTML(p)).join('\n');
        container.innerHTML = html;
    } catch (err) {
        console.error('renderProducts error', err);
    }
}

// Initialise automatically: récupère les posts et injecte dans la page
async function initAuto() {
    try {
        const posts = await getPosts();
        if (productRow && Array.isArray(posts)) {
            // render first 8 posts as products
            renderProducts(productRow, posts.slice(0, 8));
        }
    } catch (err) {
        // log error; page remains usable
        console.error('initAuto error', err);
    }
}

initAuto();

// keep optional button handlers working if present
const btnGetAll = document.getElementById("btnGetAll");
if (btnGetAll) {
    btnGetAll.addEventListener("click", async () => {
        const posts = await getPosts();
        if (productRow && Array.isArray(posts)) renderProducts(productRow, posts);
    });
}

const btnGetOne = document.getElementById("btnGetOne");
if (btnGetOne) {
    btnGetOne.addEventListener("click", async () => {
        const post = await getPost(1);
        if (productRow && post) renderProducts(productRow, [post]);
    });
}
