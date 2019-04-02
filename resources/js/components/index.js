import Vue from 'vue'
import Card from './Card'
import Child from './Child'
import Button from './Button'
import Checkbox from './Checkbox'
import { HasError, AlertError, AlertSuccess } from 'vform'

import LimeHomeLoader from './LimeHomeLoader'
import PlacesList from './PlacesList'
import PlacesCard from './PlacesCard'

// Components that are registered globaly.
[
  Card,
  Child,
  Button,
  Checkbox,
  HasError,
  AlertError,
  AlertSuccess,

  // custom components
  LimeHomeLoader,
  PlacesList,
  PlacesCard,
].forEach(Component => {
  Vue.component(Component.name, Component)
})
