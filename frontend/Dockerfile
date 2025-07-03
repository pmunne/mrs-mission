FROM node:20.11-alpine

WORKDIR /app

COPY . .

RUN npm install && npm run build

# Esto es importante: lo que genera Vite va a /app/dist
CMD ["npm", "run", "build"]
