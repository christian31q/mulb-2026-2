function createElement(tagName, className, text) {
  const element = document.createElement(tagName);
  element.className = className;

  if (text !== undefined) {
    element.textContent = text;
  }

  return element;
}

export function createCard(walker) {
  const article = createElement("article", "professional-card");
  const image = createElement("div", "professional-card__image", "🐕");
  image.setAttribute("aria-hidden", "true");

  const content = createElement("div", "professional-card__content");
  const titleRow = createElement("div", "professional-card__title-row");
  const name = createElement("h2", "professional-card__name", walker.name);
  const status = createElement("span", "availability-badge", walker.status);
  titleRow.append(name, status);

  const details = createElement("div", "professional-card__details");
  const rating = createElement("span", "professional-card__rating");
  rating.append(
    createElement("span", "professional-card__star", "★"),
    createElement("span", "", walker.rating.toFixed(1))
  );
  const reviews = createElement(
    "span",
    "professional-card__muted",
    `(${walker.reviewCount} reseñas)`
  );
  const location = createElement(
    "span",
    "professional-card__muted",
    `📍 ${walker.location}`
  );
  details.append(rating, reviews, location);

  const description = createElement(
    "p",
    "professional-card__description",
    walker.description
  );

  const footer = createElement("div", "professional-card__footer");
  const priceDuration = createElement("div", "professional-card__price-duration");
  priceDuration.append(
    createElement("span", "professional-card__price", walker.price),
    createElement("span", "professional-card__muted", `· ${walker.duration}`)
  );
  const button = createElement("button", "professional-card__button", "Ver detalle");
  button.type = "button";
  footer.append(priceDuration, button);

  content.append(titleRow, details, description, footer);
  article.append(image, content);
  return article;
}
