INSERT INTO public.paseadores (
  name,
  status,
  rating,
  review_count,
  location,
  description,
  price,
  duration
)
SELECT seed.name,
       seed.status,
       seed.rating,
       seed.review_count,
       seed.location,
       seed.description,
       seed.price,
       seed.duration
FROM (
  VALUES
    (
      'Paseos PetGo',
      'Disponible',
      4.9,
      128,
      'Chapinero',
      'Paseos profesionales con seguimiento GPS en tiempo real.',
      20000,
      INTERVAL '30 minutes'
    ),
    (
      'Happy Walk',
      'Disponible',
      4.8,
      96,
      'Usaquén',
      'Paseos personalizados con seguimiento durante el servicio.',
      18000,
      INTERVAL '30 minutes'
    ),
    (
      'Patitas Felices',
      'Disponible',
      4.7,
      74,
      'Suba',
      'Paseos grupales e individuales con cuidadores certificados.',
      22000,
      INTERVAL '45 minutes'
    ),
    (
      'Otra cosa',
      'No Disponible',
      1.0,
      100,
      'Suba',
      'no paseamos perros',
      1000,
      INTERVAL '5 minutes'
    )
) AS seed(name, status, rating, review_count, location, description, price, duration)
WHERE NOT EXISTS (
  SELECT 1
  FROM public.paseadores AS existing
  WHERE existing.name = seed.name
);
